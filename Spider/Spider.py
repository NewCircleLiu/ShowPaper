import requests
from bs4 import BeautifulSoup
import xlwt
import pymysql
import sys
import matplotlib.pyplot as plt
plt.rcParams['font.sans-serif']=['SimHei'] 
plt.rcParams['axes.unicode_minus']=False 
def getPaperContent():
    try:
        url = "http://dblp.dagstuhl.de/pers/hd/w/Wang:Xiaofei";
        resp=requests.get(url);
        resp.encoding="utf-8";
        return (resp.text)
    except:
        print("error")
def getPaperList(content):
    soup = BeautifulSoup(content, "html.parser");
    publist = soup.find("ul", "publ-list")
    journal = publist.find_all("li","entry article") #杂志
    confer = publist.find_all("li","entry inproceedings") #会议
    papers={}
    num=0
    for i in journal: #先处理杂志类型paper
        content=[]
        content.append(str(num))
        author=[]
        data=i.find("div","data")
        authors=data.find_all("span",itemprop="author")
        for a in authors:
            author.append(a.find("span",itemprop="name").get_text())
        ##作者
        title=data.find("span","title").get_text()
        date=data.find("span",itemprop="datePublished").get_text()
        publisher=data.find_all("span",itemprop="isPartOf")[0].find("span",itemprop="name").get_text()
        content.append(title)
        content.append(author)
        content.append(date)
        content.append(publisher)
        content.append("no")
        content.append("journal")
        papers[num]=content
        num=num+1

    for i in confer:  # 会议类型
        content=[]
        content.append(str(num))
        author=[]
        data=i.find("div","data")
        authors=data.find_all("span",itemprop="author")
        for a in authors:
            author.append(a.find("span",itemprop="name").get_text())
        ##作者
        title=data.find("span","title").get_text()
        date=data.find("span",itemprop="datePublished").get_text()
        conference=data.find("span",itemprop="isPartOf").find("span",itemprop="name").get_text()
        content.append(title)
        content.append(author)
        content.append(date)
        content.append("no")
        content.append(conference)
        content.append("conference")
        papers[num]=content
#        print(content)
        num=num+1
    return papers
def toMySql(paperList): #将文献信息存入MySql
    db = pymysql.connect("localhost", "root", "yybb", "paper")
    cursor = db.cursor()
    for key,value in PaperList.items():
        #print(value)
        sql = "INSERT INTO paper\
            VALUES ('%d, '%s', '%s', '%s', '%s','%s','%s' )" % \
              (key, value[1], ",".join(value[2]), value[3], value[4],value[5],value[6])
        try:
            cursor.execute(sql)
            db.commit()
        except:
            print(sql) #手动处理单引号问题
            db.rollback()
    db.close()

def toExcel(paperList,path="./data.xls"):
    book = xlwt.Workbook();
    sheet1 = book.add_sheet("sheet1");
    sheet1.write(0, 0, "id")
    sheet1.write(0, 1, "title")
    sheet1.write(0, 2, "author")
    sheet1.write(0, 3, "date")
    sheet1.write(0, 4, "publisher")
    sheet1.write(0, 5, "confernce")
    sheet1.write(0, 6, "Type")
    row = 1
    for key, value in PaperList.items():
        for count in range(len(value)):
            if count == 2:
                str = ",".join(value[count])
                sheet1.write(row, count, str)
            else:
                sheet1.write(row, count, value[count])
        row = row + 1
    book.save(path);
def draw(paperList):
    paperListByYear={}
    for key, value in PaperList.items():
        year=int(value[3])
        if year not in paperListByYear:
            num=1
            paperListByYear[year]=num
        else:
            paperListByYear[year]=paperListByYear[year]+1
    temp=sorted(paperListByYear.items(), key=lambda d:d[0])
    print(temp)
    x=[]
    y=[]
    for key,value in temp:
        x.append(key)
        y.append(value)
    plt.plot(x, y,  linewidth=3, color='b', marker='*',
             markerfacecolor='yellow', markersize=10)
    plt.xlabel('年')
    plt.ylabel('论文数')
    plt.title('每年论文发表的数量')
    plt.legend()
    plt.savefig(str(x[0])+"_"+str(x[-1])+".png")
    plt.show()
if __name__=="__main__":
    PaperContent = getPaperContent()
    PaperList = getPaperList(PaperContent)
    toMySql(PaperList)
#    draw(PaperList)
