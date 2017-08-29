# test plot linear regression
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import matplotlib
matplotlib.style.use('ggplot')

df=pd.read_csv('data_set/test.csv', sep=',')
# df=pd.read_csv('data_set/train.csv', sep=',')
x = df['x']
y = df['y']
plt.scatter(x,y)
plt.show()

