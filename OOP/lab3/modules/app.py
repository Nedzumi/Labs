from modules.formula import Formula
from modules.comLine import ComLine

class App:
    def __init__(self):
        self.summ = 0
        self.comLine = ComLine()
        self.formula = Formula()

    def showRes(self):
        print(self.comLine.__comStr__)
        print(self.summ)

    def run(self):
        for elem in self.comLine.__comStr__:
            self.summ += self.formula.calculation(float(elem))
        self.showRes()
