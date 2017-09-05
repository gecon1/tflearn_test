# First, we'll import pandas, a data processing and CSV file I/O library
import pandas as pd
import numpy as np

# We'll also import seaborn, a Python graphing library
import warnings # current version of seaborn generates a bunch of warnings that we'll ignore
warnings.filterwarnings("ignore")
import seaborn as sns
import matplotlib.pyplot as plt
sns.set(style="white", color_codes=True)

# Next, we'll load the Iris flower dataset, which is in the "../input/" directory
stars = pd.read_csv("data_stars/c_0000.csv") # the iris dataset is now a Pandas DataFrame

# r = []


# Let's see what's in the iris data - Jupyter notebooks print the result of the last thing you do
# print(stars["x"].head())
# r = pd.Series(stars['x'],)
testrange = 100

x = stars['x'][:testrange]
y = stars['y'][:testrange]
z = stars['z'][:testrange]
r = np.sqrt(np.square(x) + np.square(y) + np.square(z))
stars['r'] = r

vx = stars['vx'][:testrange]
vy = stars['vy'][:testrange]
vz = stars['vz'][:testrange]
vr = np.sqrt(np.square(vx) + np.square(vy) + np.square(vz))
stars['vr'] = vr
print(stars[['vx','vy','vz','vr','r']][:testrange])
# all= [None,None,None]
# all['x'] = stars['x'].head()
# print(r)
# print(vr)
# plt.scatter(r,vr)

# sns.jointplot(x="r", y="vr", data=stars, size=5)

# print(stars["m"].value_counts())
#
# stars.plot(kind="scatter", x="x", y="y")
# sns.jointplot(x="x", y="y", data=stars, size=5)
# sns.FacetGrid(stars, hue="m", size=5) \
#    .map(plt.scatter, "x", "y") \
#    .add_legend()

# sns.boxplot(x="x", y="y", data=stars.head(100))

#
# ax = sns.boxplot(x="Species", y="PetalLengthCm", data=iris)
# ax = sns.stripplot(x="Species", y="PetalLengthCm", data=iris, jitter=True, edgecolor="gray")

# sns.violinplot(x="Species", y="PetalLengthCm", data=iris, size=6)

# sns.FacetGrid(iris, hue="Species", size=6) \
#    .map(sns.kdeplot, "PetalLengthCm") \
#    .add_legend()

# sns.pairplot(iris.drop("Id", axis=1), hue="Species", size=3)
# sns.pairplot(iris.filter(items=['SepalLengthCm','SepalWidthCm','PetalLengthCm','PetalWidthCm','Species']), hue="Species", size=3)
# sns.pairplot(stars.head(100).filter(items=['x','y','z']),size=3)
# sns.pairplot(stars.head(1000).filter(items=['x','vx']),size=3)

# sns.pairplot(stars.filter(items=['x','vx']),size=3)
# sns.pairplot(stars.filter(items=['y','vy']),size=3)
# sns.pairplot(stars.filter(items=['z','vz']),size=3)

plt.show()
