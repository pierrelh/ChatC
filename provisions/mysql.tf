provider "mysql" {
  endpoint = "${var.mysql_endpoint}"
  username = "${var.mysql_username}"
  password = "${var.mysql_password}"
}

resource "mysql_database" "app" {
  name = "ChatC"
}

resource "aws_db_instance" "default" {
  engine         = "mysql"
  engine_version = "5.6.17"
  instance_class = "db.t1.micro"
  name           = "initial_db"
  username       = "rootuser"
  password       = "rootpasswd"

}

provider "mysql" {
  endpoint = "${aws_db_instance.default.endpoint}"
  username = "${aws_db_instance.default.username}"
  password = "${aws_db_instance.default.password}"
}
