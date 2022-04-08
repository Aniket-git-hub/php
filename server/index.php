<?php
// create a class student with properties name, age, mobile no, email, address, course, facult, semester
class Student{
    public $name;
    public $age;
    public $mobile;
    public $email;
    public $address;
    public $course;
    public $faculty;
    public $semester;

    // create a constructor
    public function __construct($name, $age, $mobile, $email, $address, $course, $faculty, $semester){
        $this->name = $name;
        $this->age = $age;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->course = $course;
        $this->faculty = $faculty;
        $this->semester = $semester;
    }
    // create a method to display student details
    public function display(){
        echo "Name: ".$this->name."<br>";
        echo "Age: ".$this->age."<br>";
        echo "Mobile: ".$this->mobile."<br>";
        echo "Email: ".$this->email."<br>";
        echo "Address: ".$this->address."<br>";
        echo "Course: ".$this->course."<br>";
        echo "Faculty: ".$this->faculty."<br>";
        echo "Semester: ".$this->semester."<br>";
    }
    // create a method to store the student details in database
    public function store(){
        $db = new mysqli("localhost", "root", "", "collegeDB");
        if($db->connect_error){
            die("Connection failed: ".$db->connect_error);
        }
        // if the table is not created then create it
        $sql = "CREATE TABLE IF NOT EXISTS student(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            age INT(3) NOT NULL,
            mobile VARCHAR(10) NOT NULL,
            email VARCHAR(50) NOT NULL,
            address VARCHAR(50) NOT NULL,
            course VARCHAR(30) NOT NULL,
            faculty VARCHAR(30) NOT NULL,
            semester VARCHAR(30) NOT NULL
        )";
        if($db->query($sql) === TRUE){
            // if the table is created then store the student details in student table
            $sql = "INSERT INTO student(name, age, mobile, email, address, course, faculty, semester)
            VALUES('$this->name', '$this->age', '$this->mobile', '$this->email', '$this->address', '$this->course', '$this->faculty', '$this->semester')";
            if($db->query($sql) === TRUE){
                echo "Student details are stored successfully";
            }else{
                echo "Error: ".$db->error;
            }
        }else{
            echo "Error: ".$db->error;
        }
        $db->close();
    }
}

// receive the data from form if submitted
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];

    // create an object of student class
    $student = new Student($name, $age, $mobile, $email, $address, $course, $faculty, $semester);
    // display the student details
    $student->display();
    // store the student details in database
    $student->store();
}


?>