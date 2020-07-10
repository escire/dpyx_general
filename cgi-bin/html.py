#!/usr/bin/env python
# -*- coding: UTF-8 -*-
print('Content-Type: text/html; charset=utf-8\n')

import pandas as pd
import matplotlib.pylab as plt
import seaborn as sns
import io

def show(p):
    img = io.StringIO()
    p.savefig(img, format='svg')
    img.seek(0)
    print ("<div style='width:900px; height:600px'>" + img.getvalue() + "</div>")


print ("<iframe style='width:900px; height:600px' src='../svg_tooltip.svg'>" + "</iframe>")

