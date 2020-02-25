ARG FILEBEAT_VERSION
FROM store/elastic/filebeat:${FILEBEAT_VERSION}


ARG FILEBEAT_VERSION
ARG FILEBEAT_MODULES

ENV MODULES=",${FILEBEAT_MODULES},"

RUN if [[ -z "${MODULES##*,nginx,*}" ]]; then \
        filebeat modules enable nginx; \
    fi
