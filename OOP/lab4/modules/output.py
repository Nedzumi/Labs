from matplotlib import pyplot as plt

class MyOutput:
    def graf(self, origData, answer, size):
        fig, ax = plt.subplots()
        ax.plot([i for i in range(30)], origData)
        ax.plot([i for i in range(size, 30)], answer)
        plt.show()
