package com.example.Lab9.controller;

import com.example.Lab9.model.GameData;
import com.example.Lab9.model.User;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.*;

public class GameController extends HttpServlet {

    private User firstPlayer = null;
    private User secondPlayer = null;
    private Boolean isFirstPlayer;
    private Connection connection = null;

    public GameController() {
        super();
        isFirstPlayer = true;
        try{
            Class.forName("com.mysql.jdbc.Driver");
            this.connection = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/battleship","matei","mamaligacutocana");

        }catch(Exception e)
        { System.out.println(e);}
    }


    private void addToBoardTable(User user) {
        try {

            for (int i = 0; i < 6; ++i) {
                for (int j = 0; j < 6; ++j) {

                    String query = "INSERT INTO board (player_id, x, y, value) VALUES (?, ?, ?, ?)";
                    PreparedStatement statement = connection.prepareStatement(query);
                    statement.setDouble(1, user.getUserId());
                    statement.setInt(2, i);
                    statement.setInt(3, j);
                    statement.setInt(4, 0);

                    statement.execute();

                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void updateBoardTable(User user) {
        try {

            for (int i = 0; i < 6; ++i) {
                for (int j = 0; j < 6; ++j) {

                    String query = "UPDATE board SET value = ? WHERE player_id = ? AND x = ? AND y = ?";
                    PreparedStatement statement = connection.prepareStatement(query);
                    statement.setInt(1, user.board.getForPosition(i, j));
                    statement.setDouble(2, user.getUserId());
                    statement.setInt(3, i);
                    statement.setInt(4, j);

                    statement.execute();

                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void flushForUser(User user, HttpServletResponse response) throws IOException {

        response.getWriter().print("[");
        for (int i = 0; i < 5; ++i) {
            response.getWriter().print("[");
            for (int j = 0; j < 5; ++j) {
                response.getWriter().print(user.board.getForPosition(i, j) + ",");
            }
            response.getWriter().print(user.board.getForPosition(i, 5) + "],");
        }
        response.getWriter().print("[");
        for (int j = 0; j < 5; ++j) {
            response.getWriter().print(user.board.getForPosition(5, j) + ",");
        }
        response.getWriter().print(user.board.getForPosition(5, 5) + "]]");


    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, java.io.IOException {

        if (firstPlayer == null || secondPlayer == null) {
            response.setContentType("application/json");
            response.getWriter().print("{\"response\":\"there should be 2 players connected\"}");
            response.getWriter().flush();
            return;
        }

        User currentUser;
        User otherUser;
        if (((GameData) (request.getSession().getAttribute("GameData"))).userId.equals(firstPlayer.getUserId())) {
            currentUser = firstPlayer;
            otherUser = secondPlayer;
        } else {
            currentUser = secondPlayer;
            otherUser = firstPlayer;
        }


        response.setContentType("application/json");
        response.getWriter().print("{\"response\":\"success\",\"board\":");

        flushForUser(currentUser, response);
        response.getWriter().print(",\"opponent\":");
        flushForUser(otherUser, response);

        response.getWriter().print("}");

    }

    protected void doPost(HttpServletRequest request,
                          HttpServletResponse response) throws ServletException, IOException {

        if (request.getSession().getAttribute("GameData") == null) {
            GameData data = new GameData();
            if (firstPlayer == null) {
                firstPlayer = new User(data.userId);
                addToBoardTable(firstPlayer);
            } else {
                secondPlayer = new User(data.userId);
                addToBoardTable(secondPlayer);
            }
            request.getSession().setAttribute("GameData", data);
        }

        User currentUser;
        User otherUser;
        if (((GameData) (request.getSession().getAttribute("GameData"))).userId.equals(firstPlayer.getUserId())) {
            currentUser = firstPlayer;
            otherUser = secondPlayer;
        } else {
            currentUser = secondPlayer;
            otherUser = firstPlayer;
        }

        if(request.getParameter("orientation") == null) {

            if (firstPlayer == null || secondPlayer == null) {
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"one player is missing!\"}");
                response.getWriter().flush();
                return;
            }

            Integer x = Integer.parseInt(request.getParameter("x"));
            Integer y = Integer.parseInt(request.getParameter("y"));

            if (otherUser.board.shipsAdded != 2) {
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"other player didn't select yet\"}");
                response.getWriter().flush();
                return;
            }
            if (currentUser.board.shipsAdded != 2) {
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"please select ships first\"}");
                response.getWriter().flush();
                return;
            }

            if ((isFirstPlayer && currentUser != firstPlayer) || (!isFirstPlayer && currentUser != secondPlayer)) {
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"other player's turn\"}");
                response.getWriter().flush();
                return;
            }

            otherUser.board.attack(x, y);
            isFirstPlayer = !isFirstPlayer;
            response.setContentType("application/json");
            response.getWriter().print("{\"response\":\"success\"}");
            response.getWriter().flush();
            updateBoardTable(currentUser);
            updateBoardTable(otherUser);
        }
        else {

            Integer x = Integer.parseInt(request.getParameter("x"));
            Integer y = Integer.parseInt(request.getParameter("y"));
            Integer orientation = Integer.parseInt(request.getParameter("orientation"));
            if (currentUser.board.shipsAdded != 2) {
                currentUser.board.addShip(x, y, orientation);
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"success\"}");
                response.getWriter().flush();
                updateBoardTable(currentUser);
            }
            else {
                response.setContentType("application/json");
                response.getWriter().print("{\"response\":\"there are 2 ships already\"}");
                response.getWriter().flush();
            }
        }
    }

}
