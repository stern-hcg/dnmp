ARG GO_VERSION
FROM ${GO_VERSION}

ARG CONTAINER_PACKAGE_URL

RUN sed -i "s/httpredir.debian.org/${CONTAINER_PACKAGE_URL}/g" /etc/apt/sources.list \
#    && sed -i "s/security.debian.org/${CONTAINER_PACKAGE_URL}\/debian-security/g" /etc/apt/sources.list \
    && apt-get update

WORKDIR $GOPATH/src
EXPOSE 8088

CMD ["/bin/bash"]