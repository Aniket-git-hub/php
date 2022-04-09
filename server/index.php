<?php
    echo "<link rel='stylesheet' href='../styles/server.css' type='text/css' media='all' />";
class Student{
    public $name;
    public $age;
    public $mobile;
    public $email;
    public $address;
    public $course;
    public $faculty;
    public $semester;

   
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
  
    public function display(){
        // show data in table format 
        echo "<table>";
        echo "<thead><tr>
        <th>Name</th>
        <th>Age</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
        <th>Course</th>
        <th>Faculty</th>
        <th>Semester</th>
        </tr></thead>";
        echo "<tbody><tr>";
        echo "<td>".$this->name."</td>";
        echo "<td>".$this->age."</td>";
        echo "<td>".$this->mobile."</td>";
        echo "<td>".$this->email."</td>";
        echo "<td>".$this->address."</td>";
        echo "<td>".$this->course."</td>";
        echo "<td>".$this->faculty."</td>";
        echo "<td>".$this->semester."</td>";
        echo "</tr></tbody>";
        echo "</table>";

    }
    public function store(){
        $db = new mysqli("localhost", "root", "", "collegeDB");
        if($db->connect_error){
            die("Connection failed: ".$db->connect_error);
        }
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
              $sql = "SELECT * FROM student WHERE mobile=$this->mobile AND email='$this->email'";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    echo "<p class='alert'>Student already exists</p>";
                }else{
                    $sql = "INSERT INTO student(name, age, mobile, email, address, course, faculty, semester) VALUES('$this->name', '$this->age', '$this->mobile', '$this->email', '$this->address', '$this->course', '$this->faculty', '$this->semester')";
                    if($db->query($sql) === TRUE){
                        echo "<p class='alert success'>Student added successfully</p>";
                    }else{
                        echo "Error: ".$db->error;
                    }
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