package com.example.Lab9.model;

import java.sql.*;

public class Authenticator {

    private Statement statement;

    public Authenticator() {
        connect();
    }

    public void connect() {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection connection = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/battleship", "matei", "mamaligacutocana");
            statement = connection.createStatement();

        } catch (Exception e) {
            System.out.println("Error connecting:" + e.getMessage());
        }
    }

    public String authenticate(String username, String password){
        ResultSet resultSet;
        String result = "error";
        System.out.println(username + " " + password);
        try{
            resultSet = statement.executeQuery("select * from users where username='"+username+"' and password='"+password+"'");
            if(resultSet.next()){
                result = "success";
            }
            resultSet.close();

        } catch (SQLException throwable) {
            throwable.printStackTrace();
        }
        return result;
    }



}
