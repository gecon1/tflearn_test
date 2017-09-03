# First, we'll import pandas, a data processing and CSV file I/O library
import pandas as pd

# We'll also import seaborn, a Python graphing library
import warnings # current version of seaborn generates a bunch of warnings that we'll ignore
warnings.filterwarnings("ignore")
import seaborn as sns
import matplotlib.pyplot as plt
sns.set(style="white", color_codes=True)

# Next, we'll load the Iris flower dataset, which is in the "../input/" directory
iris = pd.read_csv("iris/IRIS.csv") # the iris dataset is now a Pandas DataFrame

# Let's see what's in the iris data - Jupyter notebooks print the result of the last thing you do
# print(iris.head())
# print(iris["Species"].value_counts())

# iris.plot(kind="scatter", x="SepalLengthCm", y="SepalWidthCm")
# sns.jointplot(x="SepalLengthCm", y="SepalWidthCm", data=iris, size=5)
# sns.FacetGrid(iris, hue="Species", size=5) \
#    .map(plt.scatter, "SepalLengthCm", "SepalWidthCm") \
#    .add_legend()

# sns.boxplot(x="Species", y="PetalLengthCm", data=iris)
#
# ax = sns.boxplot(x="Species", y="PetalLengthCm", data=iris)
# ax = sns.stripplot(x="Species", y="PetalLengthCm", data=iris, jitter=True, edgecolor="gray")

# sns.violinplot(x="Species", y="PetalLengthCm", data=iris, size=6)

# sns.FacetGrid(iris, hue="Species", size=6) \
#    .map(sns.kdeplot, "PetalLengthCm") \
#    .add_legend()

# sns.pairplot(iris.drop("Id", axis=1), hue="Species", size=3)
sns.pairplot(iris.filter(items=['SepalLengthCm','SepalWidthCm','PetalLengthCm','PetalWidthCm','Species']), hue="Species", size=3)

plt.show()

