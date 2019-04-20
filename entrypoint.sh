#!/usr/bin/env sh

[ -z "${PHINX_HOSTNAME}" ] && echo "PHINX_HOSTNAME was not configured" && exit 0
[ -z "${PHINX_PORT}" ] && PHINX_PORT=3306
[ -z "${PHINX_ENCODING}" ] && PHINX_ENCODING=utf8

until nc -v -z ${PHINX_HOSTNAME} ${PHINX_PORT}; do
    echo "Connecting to Mysql..."
    sleep 2
done

exec $@