class Formula:  # Решение формулы
    def calculation(self, elem):
        if elem == 0:
            return ZeroDivisionError
        return 1 / (elem * 3)
