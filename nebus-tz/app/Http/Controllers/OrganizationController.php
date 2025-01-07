<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Organization API",
 *     version="1.0.0",
 *     description="API for managing organizations"
 * )
 */

/**
 * @OA\Tag(
 *     name="Organization",
 *     description="Operations related to organizations"
 * )
 */

/**
 * @OA\SecurityScheme(
 *     securityScheme="apiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Api-key-custom",
 *     description="API Key for authentication"
 * )
 */
class OrganizationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/organizations/building/{buildingId}",
     *     summary="Get organizations by building ID",
     *     description="Get organizations that belong to a building based on its ID",
     *     operationId="getOrganizationsByBuilding",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="Building ID")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organizations retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Building not found",
     *     )
     * )
     */
    public function getOrganizationsByBuilding($buildingId)
    {
        $building = Building::find($buildingId);
        if (!$building) {
            return response()->json(['error' => 'Building not found'], 404);
        }

        return response()->json($building->organizations);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/activity/{activityId}",
     *     summary="Get organizations by activity ID",
     *     description="Get organizations that belong to an activity based on its ID",
     *     operationId="getOrganizationsByActivity",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="Activity ID")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organizations retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity not found",
     *     )
     * )
     */
    public function getOrganizationsByActivity($activityId)
    {
        $organizations = Activity::find($activityId)->organizations;
        return response()->json($organizations);
    }

    /**
     * @OA\Get(
     *     path="/api/organization/{id}",
     *     summary="Get organization by ID",
     *     description="Get the details of an organization by its ID",
     *     operationId="getOrganization",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="Organization ID")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organization retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Organization")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Organization not found",
     *     )
     * )
     */
    public function getOrganization($id)
    {
        $organization = Organization::find($id);
        if (!$organization) {
            return response()->json(['error' => 'Organization not found'], 404);
        }

        return response()->json($organization);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/near",
     *     summary="Get organizations in a specified radius from a point",
     *     description="Get a list of organizations within a specified radius (in kilometers) from a given latitude and longitude",
     *     operationId="getOrganizationsInRadius",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number", format="float", description="Latitude")
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number", format="float", description="Longitude")
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number", format="float", description="Radius in kilometers")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organizations retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid parameters",
     *     )
     * )
     */
    public function getOrganizationsInRadius(Request $request)
    {
        // Получаем координаты точки и радиус
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius'); // радиус в километрах

        $radiusInMeters = $radius * 1000;

        $organizations = Organization::whereHas('building', function ($query) use ($latitude, $longitude, $radiusInMeters) {
            $query->whereRaw(
                "ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?",
                [$longitude, $latitude, $radiusInMeters]
            );
        })
            ->with(['building', 'activities']) // Загружаем связи
            ->get();

        return response()->json($organizations);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/search/{name}",
     *     summary="Search organizations by name",
     *     description="Search organizations by a name (partial matching)",
     *     operationId="searchOrganizationsByName",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", description="Organization name")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organizations retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No organizations found",
     *     )
     * )
     */
    public function searchOrganizationsByName($name)
    {
        $organizations = Organization::where('name', 'like', '%' . $name . '%')->get();
        return response()->json($organizations);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/activity-name",
     *     summary="Get organizations by activity name",
     *     description="Get organizations that belong to an activity based on its name",
     *     operationId="getOrganizationsByActivityName",
     *     tags={"Organization"},
     *     security={{"apiKey": {}}},
     *     @OA\Parameter(
     *         name="activity_name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", description="Activity name")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organizations retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity not found",
     *     )
     * )
     */
    public function getOrganizationsByActivityName(Request $request)
    {
        $activityName = $request->input('activity_name');

        $activity = Activity::where('name', $activityName)->with('children')->first();

        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        $activityIds = $activity->children->pluck('id')->toArray();
        $activityIds[] = $activity->id;

        $organizations = Organization::whereHas('activities', function ($query) use ($activityIds) {
            $query->whereIn('activity_id', $activityIds);
        })
            ->get();

        return response()->json($organizations);
    }
}
