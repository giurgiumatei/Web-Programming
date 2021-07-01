package com.example.Lab9.controller;

import com.example.Lab9.model.Authenticator;

import java.io.IOException;


import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class LoginController extends HttpServlet {

    private int numberOfPlayers;

    public LoginController() {
        super();
        this.numberOfPlayers = 0;
    }

    protected void doPost(HttpServletRequest request,
                          HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        System.out.println(username + " " + password);
        Authenticator authenticator = new Authenticator();
        String result = authenticator.authenticate(username, password);

        if (result.equals("error")) {
            request.getRequestDispatcher("error-login.jsp").forward(request, response);
        } else {

            RequestDispatcher requestDispatcher;

            if (this.numberOfPlayers < 2) {
                this.numberOfPlayers += 1;
                requestDispatcher = request.getRequestDispatcher("/success.jsp");

            } else {
                requestDispatcher = request.getRequestDispatcher("/error-max-players.jsp");
            }
            requestDispatcher.forward(request, response);
        }
    }

}