/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.studyIn.alphaApp;

import java.security.SecureRandom;

/**
 *
 * @author Jimmy
 */
public class CreateAccount {
    //Private
    private String username;
    private SecureRandom salt;
    private PasswordHandler setPass;
    
    public CreateAccount(String user, String pass){
        //try{
        //} catch(&&& e){
        //    System.err("Account Already Exists");
        //}
        username = user;
        salt = generateSalt();
        setPass = new PasswordHandler(pass,salt);
    }
    
    private SecureRandom generateSalt(){
        SecureRandom rand = new SecureRandom();
        byte bytes[] = new byte[32];
        rand.nextBytes(bytes);
        return rand;
    }
    
}
