# Mobile-Based-Attendance-System-App
The purpose of developing a Mobile-Based Attendance System is to computerized the tradition way of taking attendance. Another purpose for developing this software is to generate the report automatically at the end of the session or in the between of the session. This application will also send message to student whose attendance is below 75%.

## Tools and Technologies

Front-end: XML, HTML, CSS, Bootstrap, JavaScript

Database: MySQL

IDE: Android Studio

Server: Xampp Server

## Overall Features

1. Manage department, subject, teacher, course and student records.
2. Allow teachers to take/edit attendance for their respective subjects.
3. Teachers can generate new schedule to take classes.
4. View attendance and download attendance sheets.
5. Generate customized reports of student attendance.
6. Give hierarchical rights
7. Archive and restore attendance
8. Allow students to view their attendance
9. View attendance

#### Admin (College head)

1. Manage Faculty and Department details
2. Restore archived attendance

#### Faculty

1. Make schedules to take classes
2. Take and Edit attendance
3. Download attendance sheet
4. View customized attendance reports

#### Student

View attendance per subject

## Development Setup

1. Download zip file and U nzip file on your local server.
2. Put 'Attendance PHP files' folder inside "C:\xampp\htdocs" .
3. Database Configuration
4. Go To “localhost/phpmyadmin” in any browser
5. Create Database named attendance.
6. Import database attendance.sql from downloaded folder(inside Attendance PHP Files)

## Localhost Setup For Android Application:- 

1. Start Wamp/Xampp server. 

2. In cmd run "ipconfig" command (make sure your pc/laptop is connected to network via lan/wifi) and note the ip of lan/wifi network . 

3. Open android studio and import this project.

  (After successfull gradle build open Constants.java and follow below steps) 

4. Change url address as per your ip address(obtain from step 2) in com/java/attendance/misc/utils/Constants.java file 

These url :- 

    public static final String ROOT_URL = "http://192.168.43.181/Attendance2/v1";
    
    public static final String ROOT_URL2 = "http://192.168.43.1810/Attendance-System-master";

5. Build app in android studio. 

6. Finally test app in emulator/phone (for phone, you should config xampp to work on your phone ).

## Screenshots

![Screenshot_20190520-152456](https://user-images.githubusercontent.com/51712696/59298231-ec30e880-8c3e-11e9-83ee-c3f9264cf427.png)

![Screenshot_20190520-152500](https://user-images.githubusercontent.com/51712696/59298128-ad029780-8c3e-11e9-9ade-8a8fcec7253b.png)

![Screenshot_20190520-152900](https://user-images.githubusercontent.com/51712696/59298487-82650e80-8c3f-11e9-9673-78fd91a597d6.png)
![Screenshot_20190520-152918](https://user-images.githubusercontent.com/51712696/59298491-82650e80-8c3f-11e9-8ca0-567477dcdd97.png)
![Screenshot_20190520-152929](https://user-images.githubusercontent.com/51712696/59298492-82650e80-8c3f-11e9-92cf-53dd1a231d0f.png)
![Screenshot_20190520-153005](https://user-images.githubusercontent.com/51712696/59298494-82fda500-8c3f-11e9-8f7d-3f85019bbe50.png)
![Screenshot_20190520-153013](https://user-images.githubusercontent.com/51712696/59298495-82fda500-8c3f-11e9-80a7-b2d3112e5b97.png)
![Screenshot_20190521-100032](https://user-images.githubusercontent.com/51712696/59298497-83963b80-8c3f-11e9-8315-31ba3967043d.png)
![Screenshot_20190520-152456](https://user-images.githubusercontent.com/51712696/59298499-83963b80-8c3f-11e9-8eea-21821269fea3.png)
![Screenshot_20190520-152515](https://user-images.githubusercontent.com/51712696/59298502-842ed200-8c3f-11e9-92ba-e1b2b072c0f1.png)
![Screenshot_20190520-152545](https://user-images.githubusercontent.com/51712696/59298503-842ed200-8c3f-11e9-9179-4c4be8d97874.png)
![Screenshot_20190520-152548](https://user-images.githubusercontent.com/51712696/59298504-84c76880-8c3f-11e9-9708-d2a18ab3157c.png)
![Screenshot_20190520-152553](https://user-images.githubusercontent.com/51712696/59298505-84c76880-8c3f-11e9-8889-a2f7576385d8.png)
![Screenshot_20190520-152613](https://user-images.githubusercontent.com/51712696/59298507-855fff00-8c3f-11e9-831a-d5e4af4772ed.png)
![Screenshot_20190520-152617](https://user-images.githubusercontent.com/51712696/59298508-855fff00-8c3f-11e9-86a5-1726357d0c13.png)
![Screenshot_20190520-152640](https://user-images.githubusercontent.com/51712696/59298509-85f89580-8c3f-11e9-88e3-e7464120bfff.png)
![Screenshot_20190520-152646](https://user-images.githubusercontent.com/51712696/59298510-85f89580-8c3f-11e9-868e-5b47ad7d17fe.png)
![Screenshot_20190520-152653](https://user-images.githubusercontent.com/51712696/59298511-86912c00-8c3f-11e9-8107-6569eefad25b.png)
![Screenshot_20190520-152657](https://user-images.githubusercontent.com/51712696/59298512-86912c00-8c3f-11e9-89d5-b533707f08d8.png)
![Screenshot_20190520-152701](https://user-images.githubusercontent.com/51712696/59298514-86912c00-8c3f-11e9-8ef4-197709e9cbb2.png)
![Screenshot_20190520-152721](https://user-images.githubusercontent.com/51712696/59298515-8729c280-8c3f-11e9-8d0f-195997088cd6.png)





