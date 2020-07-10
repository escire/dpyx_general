#!/usr/bin/env python
# -*- coding: UTF-8 -*-
print('Content-Type: text/html; charset=utf-8\n')

import io



def show(p):
    img = io.StringIO()
    p.savefig(img, format='svg')
    img.seek(0)
    print ("<div style='width:600px'>" + img.getvalue() + "</div>")

from plotly.tools import FigureFactory as ff
from datetime import datetime
import numpy as np

import plotly.graph_objects as go

fig = go.Figure(data=[go.Scatter(
    x=[1, 3.2, 5.4, 7.6, 9.8, 12.5],
    y=[1, 3.2, 5.4, 7.6, 9.8, 12.5],
    mode='markers',
    marker=dict(
        color=[120, 125, 130, 135, 140, 145],
        size=[15, 30, 55, 70, 90, 110],
        showscale=True
        )
)])

fig.show()
