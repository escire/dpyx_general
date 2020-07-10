#!/usr/bin/env python
# -*- coding: UTF-8 -*-
print('Content-Type: text/html; charset=utf-8\n')

import matplotlib.pyplot as plt
import numpy as np
import seaborn as sns
import io

plt.switch_backend('agg')


def show(p):
    img = io.StringIO()
    p.savefig(img, format='svg')
    img.seek(0)
    print ("%html <div style='width:600px'>" + img.getvalue() + "</div>")


# create data
x = np.random.rand(15)
y = x+np.random.rand(15)
z = x+np.random.rand(15)
z=z*z

# Change color with c and alpha. I map the color to the X axis value.
plt.scatter(x, y, s=z*2000, c=x, cmap="Blues", alpha=0.4, edgecolors="grey", linewidth=2)

# Add titles (main and on axis)
plt.xlabel("the X axis")
plt.ylabel("the Y axis")
plt.title("A colored bubble plot")

show(plt)

