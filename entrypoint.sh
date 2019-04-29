#!/usr/bin/env sh

for e in $(env | grep ^DATABASE_); do
    export -p $(echo $e | sed 's/^DATABASE_/PHINX_/');
done

# patch up the mismatch of naming conventions
export -p PHINX_DATABASE=${DATABASE_NAME}

[ -z "${PHINX_HOSTNAME}" ] && echo "PHINX_HOSTNAME was not configured" && exit 0
[ -z "${PHINX_DATABASE}" ] && echo "PHINX_DATABASE was not configured" && exit 0
[ -z "${PHINX_PORT}" ] && PHINX_PORT=3306
[ -z "${PHINX_ENCODING}" ] && PHINX_ENCODING=utf8

until nc -v -z ${PHINX_HOSTNAME} ${PHINX_PORT}; do
    echo "Connecting to Mysql ${PHINX_HOSTNAME}:${PHINX_PORT}..."
    sleep 2
done

exec $@