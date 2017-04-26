import math

class Formula:   # Поиск ответа
    def setAns(self, lastAns, num):
        self.__ans__ = (lastAns + (num / lastAns)) / 2

    def getAns(self):
        return self.__ans__

    def showAns(self, num):
        print('Answer is {}'.format(self.getAns()))
        print('Correct answer is {}'.format(math.sqrt(num.getNum())))
