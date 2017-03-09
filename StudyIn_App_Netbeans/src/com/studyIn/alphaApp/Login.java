/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.studyIn.alphaApp;

import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.TextArea;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;

/**
 *
 * @author Jimmy
 */
public class Login {
    public byte[] sesh_Token;
    
    //Signs Into account
    public Login(String username,String password) {
        //Start new session
        DbConnect checkC = new DbConnect();
        //check username exists
        checkC.checkLogin(username,password);
        
        if() {
            //if user doesnt exist
        } else {
            //user does exist
        }
        //generate salt
        PasswordHandler pass = new PasswordHandler(password, getSalt());
        DbConnect checkC = new DbConnect();
    }
    
    private Boolean UserExist(String username, DbConnect connection){
        //use db connection to return JSON 
    }
    
    
    public void ShowLoginForm() {
        Form loginForm = new Form();

    // the blue theme styles the title area normally this is good but in this case we don't want the blue bar at the top
        loginForm.getTitleArea().setUIID("Container");
        loginForm.setLayout(new BorderLayout());
        loginForm.setUIID("MainForm");
        Container cnt = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        cnt.setUIID("Padding");

        TextField user = new TextField("","Username",20, TextArea.ANY);
        TextField password = new TextField("","Password",20, TextArea.PASSWORD);
        Button createAccount = new Button("Create Account");
        Button signIn = new Button("Sign In");
      //Button loginWithGoogle = new Button("Signin with Google");
      //Button loginWithFacebook = new Button("Signin with Facebook");
        
      //get salt and hash password
      
        
        cnt.add("Username").add(user)
            .add("Password").add(password);
        cnt.addComponent(signIn);
        cnt.addComponent(createAccount);
      //cnt.addComponent(loginWithGoogle);
      //cnt.addComponent(loginWithFacebook);
        signIn.addActionListener((e) -> { logIn(user.getText(),password.getText()); });
      //loginWithGoogle.addActionListener((e) -> { doLogin(GoogleConnect.getInstance());});
      //loginWithFacebook.addActionListener((e) -> { doLogin(FacebookConnect.getInstance());});
    
        loginForm.addComponent(BorderLayout.SOUTH, cnt);
        loginForm.show();
    }
        
    
    public void getSalt() {

    }
    
}
