# Используем официальный образ PostgreSQL
FROM postgres:latest

# Устанавливаем PostGIS
RUN apt-get update && \
    apt-get install -y postgis postgresql-13-postgis-3 && \
    rm -rf /var/lib/apt/lists/*

# Копируем init-скрипт для установки расширений при старте контейнера (по желанию)
# COPY init.sql /docker-entrypoint-initdb.d/
