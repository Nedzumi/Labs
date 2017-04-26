class Window():
    def __init__(self):
        self.__win__ = []

    def setWin(self, num):
        self.__win__.append(num)

    def getWin(self):
        return self.__win__

    def sliceWin(self):
        self.__win__ = self.__win__[1:]
