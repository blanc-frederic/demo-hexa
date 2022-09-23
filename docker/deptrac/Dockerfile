FROM php:8.1-cli

RUN curl -LS https://github.com/qossmic/deptrac/releases/download/0.24.0/deptrac.phar -o deptrac.phar \
    && chmod +x deptrac.phar && mv deptrac.phar /usr/local/bin/deptrac
