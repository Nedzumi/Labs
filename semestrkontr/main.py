# from tkinter import *
import tkinter as tk
from tkinter import ttk
from PIL import ImageTk, Image
import random
from io import BytesIO

import magic8ball
import coolimage
import birthdays


class MainApp(tk.Tk):
    def __init__(self, *args, **kwargs):
        tk.Tk.__init__(self, *args, **kwargs)
        self.title("VK help")

        self.notebook = ttk.Notebook(self)
        self.notebook.pack(expand=1, fill="both")
        # self.main_container = tk.Frame(self, borderwidth=1, relief="sunken",
        #                      width=500, height=500)
        # self.main_container.grid_propagate(False)
        # self.main_container.pack(fill='both', expand=True)

        self.init_magic8ball_gui()
        self.init_coolimage_gui()
        self.init_birthdays_gui()

    def init_magic8ball_gui(self):
        magic8ball_page = ttk.Frame(self.notebook)
        self.notebook.add(magic8ball_page, text='Не могу решиться')

        magic8ball_container = tk.Frame(magic8ball_page, borderwidth=1, relief="sunken", pady=10)
        magic8ball_container.pack(fill=tk.X, side=tk.TOP)

        questionLabel = tk.Label(magic8ball_container, text='Введи вопрос:')
        questionLabel.grid(row=0, column=0)
        self.questionEntry = tk.Entry(magic8ball_container)
        self.questionEntry.grid(row=0, column=1)

        oracleBtn = tk.Button(magic8ball_container, text='Получить предсказание')
        oracleBtn.bind("<Button-1>", self.oracle_click)
        oracleBtn.grid(row=0, column=3)

        self.oracleLabelQuestion = tk.Label(magic8ball_container, font='Arial 10')
        self.oracleLabelQuestion.grid(row=1, columnspan=3)
        self.oracleLabelAnswer = tk.Label(magic8ball_container, font='Arial 10')
        self.oracleLabelAnswer.grid(row=2, columnspan=3)
        # self.oracleLabel.pack(side=tk.BOTTOM, fill=tk.X)

    def oracle_click(self, ev):
        if self.questionEntry.get():
            self.oracleLabelQuestion.config(text=self.questionEntry.get())
            self.oracleLabelAnswer.config(text=magic8ball.get_answer())
            self.questionEntry.delete(0, tk.END)
        else:
            self.oracleLabelQuestion.config(text="Введи вопрос!")
            self.oracleLabelAnswer.config(text="")

    def init_coolimage_gui(self):
        coolimage_page = ttk.Frame(self.notebook)
        self.notebook.add(coolimage_page, text='Хочу смеяться 5 минут!')

        coolimage_container = tk.Frame(coolimage_page, borderwidth=1, relief="sunken", pady=10)
        coolimage_container.pack(fill=tk.X, side=tk.TOP)

        memgroupLabel = tk.Label(coolimage_container, text='Паблик с мемами:')
        memgroupLabel.grid(row=0, column=0)
        self.memgroupEntry = tk.Entry(coolimage_container)
        self.memgroupEntry.insert(tk.END, 'mem1001')
        self.memgroupEntry.grid(row=0, column=1)

        memBtn = tk.Button(coolimage_container, text='Выбери мем!')
        memBtn.bind("<Button-1>", self.mem_click)
        memBtn.grid(row=0, column=3)

        self.memimage = tk.Label(coolimage_container)
        self.memimage.grid(row=1, columnspan=3)

        self.memtext = tk.Message(coolimage_container, font='Arial 10', aspect=500)
        self.memtext.grid(row=2, columnspan=3)

    def mem_click(self, ev):
        try:
            image, text = coolimage.get_random_mem(self.memgroupEntry.get())
        except Exception as ex:
            print(ex)
            image = None
            text = ''

        self.memtext.config(text=text)

        if image:
            imgdata = Image.open(BytesIO(image))
            imgdata.thumbnail((500, 500), Image.ANTIALIAS)
            photoimage = ImageTk.PhotoImage(imgdata)
        else:
            photoimage = None

        self.memimage.configure(image=photoimage)
        self.memimage.image = photoimage

    def init_birthdays_gui(self):
        birthdays_page = ttk.Frame(self.notebook)
        self.notebook.add(birthdays_page, text='У кого днюха?')

        birthdays_container = tk.Frame(birthdays_page, borderwidth=1, relief="sunken", pady=10)
        birthdays_container.pack(fill=tk.X, side=tk.TOP)

        useridLabel = tk.Label(birthdays_container, text='ID страницы')
        useridLabel.grid(row=0, column=0)
        self.useridEntry = tk.Entry(birthdays_container)
        self.useridEntry.insert(tk.END, random.randint(1, 5000000))
        self.useridEntry.grid(row=0, column=1)

        bdaysBtn = tk.Button(birthdays_container, text='Ближайшие днюхи у друзей')
        bdaysBtn.bind("<Button-1>", self.bdays_click)
        bdaysBtn.grid(row=0, column=2)

        self.bdaysvar = tk.StringVar()
        bdaystext = tk.Message(birthdays_container, font='Arial 10', aspect=500,
                                    textvariable=self.bdaysvar, relief=tk.RAISED)
        bdaystext.grid(row=2, columnspan=3)
        pass


    def bdays_click(self, ev):
        user_id = self.useridEntry.get()
        if not user_id:
            self.bdaysvar.set('Введи id пользователя')
            return

        user_id = user_id.lstrip('id')

        try:
            user_id = int(user_id)
        except:
            self.bdaysvar.set('Введи id пользователя')
            return

        friends = birthdays.get_friends_with_nearest_birthday(user_id, 5)

        if not friends:
            self.bdaysvar.set('Ошибка. Попробуй другой id')
            self.useridEntry.delete(0, tk.END)
            return

        user_name = birthdays.get_user_name(user_id)

        s = 'Ближайшие дни рождения у друзей пользователя "{}":\n\n'.format(user_name)
        for f in friends:
            s += '{}: {}\n'.format(f['name'], f['bdate'])

        self.bdaysvar.set(s)


if __name__ == "__main__":
    app = MainApp()
    app.mainloop()
