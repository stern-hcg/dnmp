#!/bin/sh

export MC="-j$(nproc)"

tar -xf ImageMagick-6.9.10-11.tar.gz \
&& ( cd ImageMagick6-6.9.10-11 && ./configure && make clean && make ${MC} && make install )

mkdir -p magickwand \
 && tar -xf magickwand-1.0.9.tgz --strip-components=1 \
 && ( \
     cd MagickWandForPHP-1.0.9 \
     && /usr/local/bin/phpize \
     && ./configure --with-magickwand=/usr/local/include/ImageMagick-6/wand \
     && make clean && make ${MC} && make install \
 ) && echo "extension=magickwand.so" >> /usr/local/etc/php/conf.d/magickwand.ini
