import math

class Number:
    def __init__(self, s):
        self.__s__ = s

    def getNum(self):
        return self.__s__
class LastAnswer:
    def __init__(self):
        self.__x__ = 3

    def getLA(self):
        return self.__x__

    def setLA(self, ans):
        self.__x__ = ans
#По формуле Герона
class formula:
    def setAns(self, x, s):
        self.__ans__ = (x + (s / x)) /2

    def getAns(self):
        return self.__ans__

if __name__ == '__main__':
    print('Enter the number: ')
    s = Number(float(input()))
    x = LastAnswer()
    answer = formula()
    answer.setAns(x.getLA(), s.getNum())
    #Приблизительное значение ответа не должно отличатся на:
    while abs(x.getLA() - answer.getAns()) > 0.00005:
        x.setLA(answer.getAns())
        answer.setAns(x.getLA(), s.getNum())

    print('Answer = {}'.format(answer.getAns()))

