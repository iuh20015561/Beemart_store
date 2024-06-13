import pymysql
import pandas as pd
from sklearn import linear_model
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_squared_error
from math import sqrt
from sklearn.preprocessing import StandardScaler
import pickle
import time
from sqlalchemy import create_engine
from sqlalchemy import URL

def loadTrainData():
    URL_OBj = URL.create("mysql+pymysql",username="root",host="localhost",database="beemart")
    cnx = create_engine(f"{URL_OBj}?charset=utf8")    
    
    # time.sleep(5)
    query = "SELECT sanpham.maSanPham, baocaobanhang.thangBanHang, baocaobanhang.soLuongTonKho, baocaobanhang.soLuongDaBan, sanpham.giaBan FROM baocaobanhang JOIN sanpham ON baocaobanhang.maSanPham = sanpham.maSanPham "
    df = pd.read_sql(query, con=cnx)
    
    print(f"Load data successfully")
    return df
def dataCleaning(df):
    thangBH=[]
    for i in df["thangBanHang"].values:
        thangBH.append(int(i.astype(str).split("-")[1]))
        
    df.thangBanHang  = thangBH    

    return df
def dataPreprocessing(df):
    X = df[["giaBan","maSanPham", "thangBanHang"]]
    y = df["soLuongDaBan"] 
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=16)
    print(f"Data preprocessing successfully")

    return X_train, X_test, y_train, y_test
def modelBuilding():
    model = linear_model.LinearRegression() 
    print(f"Model building successfully")
    return model
def modelTraining(model, X_train, y_train):
    model.fit(X_train, y_train)
    print(f"Model training successfully")
    return model
def modelEvaluate(model, X_test, y_test):
    predicted_quantity = model.predict(X_test)
    rmse = sqrt(mean_squared_error(y_test, predicted_quantity))
    print(f"Root Mean Squared Error: {rmse}")
def modelSave(model):
    filename = 'Linear Regression.sav'
    pickle.dump(model, open(filename, 'wb'))  
    print("Model saved")
def main():
    try:
       df = loadTrainData()
       df = dataCleaning(df)
       X_train, X_test, y_train, y_test = dataPreprocessing(df)
       model = modelBuilding()
       model = modelTraining(model, X_train, y_train)
       modelEvaluate(model, X_test, y_test)
       modelSave(model)
    except Exception as e:
       print(f"Error: {e}")
if __name__ == "__main__":
    main()