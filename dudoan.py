import pickle
import pandas as pd
from sqlalchemy import create_engine, URL
import random
from sqlalchemy.sql import text

def loadModel(filename):
    loadModel = pickle.load(open(filename, "rb"))
    return loadModel

def loadData():
    URL_OBj = URL.create("mysql+pymysql", username="root", host="localhost", database="beemart")
    cnx = create_engine(f"{URL_OBj}?charset=utf8")

    query = "SELECT sanpham.maSanPham, baocaobanhang.thangBanHang, baocaobanhang.soLuongTonKho, baocaobanhang.soLuongDaBan, sanpham.giaBan FROM baocaobanhang JOIN sanpham ON baocaobanhang.maSanPham = sanpham.maSanPham "
    df = pd.read_sql(query, con=cnx)
    dataCleaning(df)
    X = df[["giaBan", "maSanPham", "thangBanHang"]]
    y = df["soLuongDaBan"]

    return X, y

def dataCleaning(df):
    thangBH = []
    for i in df["thangBanHang"].values:
        thangBH.append(int(i.astype(str).split("-")[1]))

    df.thangBanHang = thangBH

def saveResult(result, X):
    X.drop(columns=["giaBan"])
    Rin = random.randint(0, X.shape[0])
    result = int(result[Rin])
    feature = X.iloc[[Rin]]
    URL_OBj = URL.create("mysql+pymysql", username="root", host="localhost", database="beemart")
    cnx = create_engine(f"{URL_OBj}?charset=utf8")
    
    with cnx.connect() as conn:
        query = f"INSERT INTO solieududoan(maSanPham,soLuongCanNhapKho,thangDuDoan) VALUES('{feature['maSanPham'].values[0]}', '{result}', '{feature['thangBanHang'].values[0]}')"
        query = text(query)
        conn.execute(query)
        conn.commit()
        print("Predict and save result successfully!")

def main():
    model = loadModel("Linear Regression.sav")
    X, y = loadData()
    result = model.predict(X)
    saveResult(result, X)

if __name__ == "__main__":
    main()
