#!/usr/bin/perl
#####################################################################################################
# File: generate_pages.pl
#
# A perl script to generate webpages using photos, text files, folder names, file names as input.
# The script is designed to be run using crontab, so that by simply loading photos into a directory
# and using some known file naming conventions will generate a blog and photo board for the photos.
# Great for an overseas trip around the world!
#
# Author: David Wilkie (dwilkie@gmail.com)
# 
# Modified: 2008-12-01 - Started writing code!
#
# todo:
# Everything!
#####################################################################################################

use strict;
use warnings;
use Iterator::IO;

