#! C:\Users\HP\AppData\Local\Programs\Python\Python38\python.exe
import sys
import pickle
from sklearn.ensemble import RandomForestClassifier
def ans(x_prac):
    pickle_in = open("studentgrades.pickle", "rb")
    linear = pickle.load(pickle_in)
    # print(linear.score(x_test, y_test))
    return linear.predict(x_prac)
abc=[int(i) for i in sys.argv[1].split(",")]

# print()
print(ans([abc])[0])
