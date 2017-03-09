/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.studyIn.alphaApp;

import java.io.IOException;
import java.io.InputStream;
//import java.util.Properties;
//import com.codename1.social.Login;
import com.codename1.ws.RESTfulWebServiceClient;
import com.codename1.ws.RESTfulWebServiceClient.Query;
import com.codename1.ws.RESTfulWebServiceClient.RowSet;

//import oracle.sql.*;
//import oracle.jdbc.*;
//import oracle.net.*;

//import com.mysql.jdbc.*;
//import org.gjt.mm.mysql.*;
/**
 *
 * @author Jimmy
 */
public class DbConnect {
    private static String DBuser;
    private static String DBpass;   
    private static String URL;
    private RESTfulWebServiceClient client;
    
    public DbConnect(){
        //get things from property file
        
        //for now they are just going to be declared
        DBuser = "root";
        DBpass = "pass";
        URL = "";
        
        client = new RESTfulWebServiceClient(URL);
    }
    
    public static Boolean checkUser(){
        
        
        return true;
    }
    
    //MYSQL Connect turoial from Javatpoint.com
    //Opens Connectino to mySQL Database to check Login
    //Returns 0 if user doesnt exist
    //Returns 1 if password is wrong
    //Returns 2 if Login is correct
    //this function will go and check if userID and password are correct
    public static byte[] checkLogin(String userName, PasswordHandler password) throws IOException{  
        //declare variable for session key
        byte[] key = new byte[32];
        URL = "http://localhost:8080/StudyInRestServer/webresources/com.studyin.studyinrestserver.accounts";
        if(){
            
        //password and username are correct, generate token
        } else {
            
        }
        //connect to DB
        
        //Something went wrong return 0
        return key;
    }
    
    private void loadUser(SuccessCallback<RowSet> callback){
        Query q = new Query().id("");
        Query k = new Query().
        client.find(q, rowset)->{
        for (Map m : rowset) {
            System.out.pritnln(m);
        }
    }
    }
    
    
}