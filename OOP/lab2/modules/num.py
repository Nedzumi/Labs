class Number:   # Класс, в котором сохраняется число, корень которого ищется
    def __init__(self):
        print('Enter the number in the square root: ')
        self.__num__ = float(input())

    def getNum(self):
        return self.__num__
