# Online-Image-Scaler

To run this program you need a SQL Database. You could achieve this by using the XAMPP Control Panel. Once you download the XAMPP, you need to put the three files ( Home, Upload, Gallery) in a single file together and place it in the "htdocs" folder path which can be found inside the XAMPP program folders. After open the XAMPP control panel and press "Start" on Apache, MySQL and FileZilla. Once all of them have started click on "Admin" on the MySQL option. Create a database with the name "images" then create the table with the name "pictures". After create 3 columns with the names. ID (tick A_I as it is primary key). data which is a mediumblob type for storing images and name which is a text type for storing how the image is being named.


I used PHP, CSS, JavaScript and the CropperJS library.

The idea of this program is one tab "Home" is the edit tab where you can resize and crop an image.
The second tab "Upload" where you can upload various images and pictures.
The third tab "Gallery" is a gallery where all the uploaded pictures and images are shown.
