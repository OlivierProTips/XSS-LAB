#!/usr/bin/env python3
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import mysql.connector

# Site variables
host = "http://localhost"
loginurl = f"{host}/login.php"
messagesurl = f"{host}/read_user_messages.php"
username = "marcus"
password = "thisisareallygoodpassword"

# DB variables
connection_params = {
    'host': "localhost",
    'user': "root",
    'password': "spongebobsquarepants",
    'database': "mydb",
}
del_req = "delete from advisor_messages"

# Connect to site
options = webdriver.FirefoxOptions()
options.add_argument('--headless')
driver = webdriver.Firefox(options=options)

driver.get(loginurl)
driver.find_element("id", "username").send_keys(username)
driver.find_element("id", "password").send_keys(password)
driver.find_element("id", "password").send_keys(Keys.ENTER)

time.sleep(5)

# Read and delete messages
while True:
    driver.get(messagesurl)
    time.sleep(2)
    try:
        with mysql.connector.connect(**connection_params) as db :
            with db.cursor() as c:
                c.execute(del_req)
                db.commit()
    except:
        pass
    time.sleep(60)
