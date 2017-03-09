/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.studyIn.alphaApp;

import java.io.UnsupportedEncodingException;
import java.security.NoSuchAlgorithmException;
import java.security.MessageDigest;
import java.security.SecureRandom;

/**
 *
 * @author Jimmy
 */
public class PasswordHandler {
    //private
    private String password;
    
//Double Hashes the password once without salt and once with
    public PasswordHandler(String pass, SecureRandom rand){
        //convert password to a hash version of it
        StringToHash(pass + rand.toString());
    }
//Takes a string and returns as SHA-1 Encrypted
    private void StringToHash(String input){
        MessageDigest md = null;
        byte[] toHash = null;
        try {
            md = MessageDigest.getInstance("SHA-1");
            toHash = input.getBytes(input);
            
        } catch(NoSuchAlgorithmException | UnsupportedEncodingException e){
            System.out.println("Unsupported Encoding Exception.");
            e.printStackTrace();
        }
        
        password = new String(md.digest(toHash));
    }
    
}
