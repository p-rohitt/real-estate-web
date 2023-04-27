# import mysql.connector
# from mysql.connector import Error


# for i in range(300):
#     try:
#         connection = mysql.connector.connect(host='localhost',
#                                              database='realestate',
#                                              user='root',
#                                              password='mysql')
#         cursor = connection.cursor()
#         photo_num = i+1
#         photoloc = "1 (" + str(photo_num) + ")"
#         path = rf'images/bedrooms/{photoloc}.jpg'

#         # Read the photo file
#         with open(path, 'rb') as file:
#             photo = file.read()

#         # Insert the photo into the database
#         insert_query = "update property set pimage2 = %s where pid = %s"
#         cursor.execute(insert_query, (photo, 301 + i))

#         connection.commit()
#         print("Photo inserted successfully into the database")

#     except Error as e:
#         print(f"Error inserting photo into MySQL database: {e}")


# pid, seller_id, agent_id ,type, price, address ,city, state, bhk, size, status, sale_type, time, user_id

import sys
import mysql.connector
from mysql.connector import Error

try:
    connection = mysql.connector.connect(host='localhost',
                                         database='realestate',
                                         user='root',
                                         password='mysql')
    cursor = connection.cursor()

    filename = sys.argv[1]
    filename2 = sys.argv[2]
    pid = sys.argv[3]

    path1 = f"admin/property/{filename}.jpg"
    path2 = f"admin/property/{filename2}.jpg"

    with open(path1, "rb") as f:
        binary_data = f.read()
    with open(path2, "rb") as f2:
        imgdata2 = f2.read()

        # Insert the photo into the database
    insert_query = "update property set pimage1 = %s , pimage2 = %s where pid = %s"
    cursor.execute(insert_query, (binary_data, imgdata2, pid))

    connection.commit()
    print(1)

except Error as e:
    print(0)
