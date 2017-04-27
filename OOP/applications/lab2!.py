eps = 0.001

class Geron():
    def __init__(self, x, y):
        self.one=x
        self.two=y
    def formula(self):
        count = 0
        while abs(self.two - self.one) >= eps:
            self.two = (self.two + self.one / self.two) / 2
            count = count+1
            if count == 10:
                return self.one, self.two


def main():
    x = float(input('Введите число: '))
    y = int(input('Введите прибл. значение: '))
    grn=Geron(x,y)
    grn.formula()
    print (grn.formula())


if __name__ == "__main__":
main()
