#The optimal values of m and b can be actually calculated with way less effort than doing a linear regression. 
#this is just to demonstrate gradient descent

from numpy import *
import matplotlib.pyplot as plt

# y = mx + b
# m is slope, b is y-intercept

def plot_points(points, m, b, err):
    # xr,yr = array()
    yr = []
    x = points[ : , 0]
    y = points[ : , 1]
    # plt.scatter(x,y)
    fig = plt.figure()
    fig2 = plt.figure()

    punkty = fig.add_subplot(111)
    error = fig.add_subplot(111)
    linia = punkty.twinx()

    punkty.set_ylabel('punkty')
    linia.set_ylabel('linia')

    punkty.scatter(x,y)
    linia.plot(x, x*m+b)

    error.plot(err)
    # pukty.legend([p, l], ['Item 1', 'Item 2'])
    plt.show()
    # print('m= {0} b={1}'.format(m,b))


def compute_error_for_line_given_points(b, m, points):
    totalError = 0
    for i in range(0, len(points)):
        x = points[i, 0]
        y = points[i, 1]
        totalError += (y - (m * x + b)) ** 2
    return totalError / float(len(points))

def step_gradient(b_current, m_current, points, learningRate):
    b_gradient = 0
    m_gradient = 0
    N = float(len(points))
    for i in range(0, len(points)):
        x = points[i, 0]
        y = points[i, 1]
        b_gradient += -(2/N) * (y - ((m_current * x) + b_current))
        m_gradient += -(2/N) * x * (y - ((m_current * x) + b_current))
    new_b = b_current - (learningRate * b_gradient)
    new_m = m_current - (learningRate * m_gradient)
    return [new_b, new_m]

def gradient_descent_runner(points, starting_b, starting_m, learning_rate, num_iterations):
    b = starting_b
    m = starting_m
    err = [None]
    for i in range(num_iterations):
        b, m = step_gradient(b, m, array(points), learning_rate)
        # err.append(compute_error_for_line_given_points(b, m, points))
        err.append(compute_error_for_line_given_points(b, m, points))
        # err[i,1] = compute_error_for_line_given_points(b, m, points)
    return [b, m, err]

def run():
    points = genfromtxt("data.csv", delimiter=",")
    learning_rate = 0.0001
    initial_b = 0 # initial y-intercept guess
    initial_m = 0 # initial slope guess
    num_iterations = 1000
    print( "Starting gradient descent at b = {0}, m = {1}, error = {2}".format(initial_b, initial_m, compute_error_for_line_given_points(initial_b, initial_m, points)))
    print( "Running...")
    [b, m, err] = gradient_descent_runner(points, initial_b, initial_m, learning_rate, num_iterations)
    print( "After {0} iterations b = {1}, m = {2}, error = {3}".format(num_iterations, b, m, compute_error_for_line_given_points(b, m, points)))
    plot_points(points, m, b, err)


if __name__ == '__main__':
    run()
