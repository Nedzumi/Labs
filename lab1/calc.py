def add(x, y):
    """Эта функциия складывает два числа"""

    return x + y


def subtract(x, y):
    """Эта функция вычитает два числа"""

    return x - y


def multiply(x, y):
    """Эта функция умножает два числа"""

    return x * y


def divide(x, y):
    """Эта функция делит два числа"""

    return x / y


# take input from the user
print("Выберите операцию.")
print("1.Сложение")
print("2.Вычитание")
print("3.Умножение")
print("4.Деление")

choice = input("Выберите действие(1/2/3/4):")

num1 = int(input("Введите первое число: "))
num2 = int(input("Введите второе число: "))

if choice == '1':
    print(num1, "+", num2, "=", add(num1, num2))

elif choice == '2':
    print(num1, "-", num2, "=", subtract(num1, num2))

elif choice == '3':
    print(num1, "*", num2, "=", multiply(num1, num2))

elif choice == '4':
    print(num1, "/", num2, "=", divide(num1, num2))
else:
    print("Invalid input")
