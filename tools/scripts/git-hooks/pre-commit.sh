#!/bin/bash

set -e

composer csrun
composer test-unit
