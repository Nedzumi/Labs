import random

class Number:  # поиск случайного числа
    def setNum(self):
        self.__num__ = random.randint(1, 100)

    def getNum(self):
        return self.__num__
