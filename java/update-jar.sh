#!/bin/sh
cd classes
jar cvf watermarker.jar watermark
jar cvf converter.jar converter
jar cvf util.jar util
mv watermarker.jar converter.jar util.jar ../lib
cd ..

