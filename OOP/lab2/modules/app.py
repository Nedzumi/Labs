from modules.number import Number
from modules.lastAnswer import LastAnswer
from modules.formula import Formula

class App:
    def __init__(self):
        # Инициализация классов
        self.num = Number()
        self.lastAns = LastAnswer()
        self.answer = Formula()
        self.answer.setAns(self.lastAns.getLA(), self.num.getNum())

    def run(self):
        # Пока ответ не будет приближенно точен
        while abs(self.lastAns.getLA() - self.answer.getAns()) > 0.00001:
            self.lastAns.setLA(self.answer.getAns())
            self.answer.setAns(self.lastAns.getLA(), self.num.getNum())

        self.answer.showAns(self.num)
