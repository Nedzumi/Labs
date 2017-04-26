class Calc:
    def summ(self, x, y):
        return x + y

    def divide(self, x, y):
        return x / y

    def diff(self, x, y):
        return x - y

    def multi(self, x, y):
        return x - y

    def main(self):
        while True:
            s = input("Введите знак (+,-,*,/): ")
            if s == '0': break
            if s in ('+', '-', '*', '/'):
                x = float(input("x="))
                y = float(input("y="))
                if s == '+':
                    print(calculator.summ(x, y))
                elif s == '-':
                    print(calculator.diff(x, y))
                elif s == '*':
                    print(calculator.multi(x, y))
                elif s == '/':
                    if y != 0:
                        print(calculator.divide(x, y))
                    else:
                        print("На ноль делить нельзя!")
            else:
                print("Неверный знак операции!")


if __name__ == "__main__":
    calculator = Calc()
    calculator.main()
