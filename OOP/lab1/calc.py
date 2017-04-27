from statistics import mean
import numpy as np
import matplotlib.pyplot as plt
import statistics

listmails = []
db = {}
spamers = {}
mail_data=[]

class Mathematics:
    def averagevalue(self, contain, n):
        return (contain / n)

class Parser:

    def mailsdict(self):
        for i in listmails:
            if i in db:
                db[i] += 1
            else:
                db[i] = 1


    def getAuthor(self):
        global vspam, listmails, db, col, authortest
        authortest=[]
        l=0
        col=0
        for line in mail_data:
            l = line.split(':')
            if l[0] == 'X-DSPAM-Confidence':
                vspam=float(l[1])
            if l[0] == 'Author':
                author = line.split(':').pop().replace('\n', '')
                listmails.append(author)
            if vspam > dspam_data and author!=authortest:
                spamers.setdefault(author, vspam)
                authortest=author
                col+=1

    def main(self):
        global author, dspam_data, mail_data, vspam
        n = 0
        l = 0
        vspam = 0
        contain = 0
        f = open('mbox.txt', 'r')
        mail_data = f.readlines()
        f.close()
        n = 0
        for line in mail_data:

            l = line.split(':')
            if l[0] == 'X-DSPAM-Confidence':
                contain = contain + float(l[1])
                n = n + 1

        dspam_data = math.averagevalue(contain, n)
        print('Среднее значение: ', dspam_data)
        mail_parser.getAuthor()
        print("Заблокировано:", col, spamers)
        mail_parser.mailsdict()
        print('Отправитель-количество писем: ', db)
        plt.bar(range(len(db)), db.values(), align='center')
        #plt.xticks(range(len(db)), db.keys())
        plt.show()


if __name__ == "__main__":
    mail_parser = Parser()
    math=Mathematics()
mail_parser.main()
    calculator.main()
