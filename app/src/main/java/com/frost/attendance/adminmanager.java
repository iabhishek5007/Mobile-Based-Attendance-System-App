package com.frost.attendance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;

public class adminmanager extends AppCompatActivity {
    Button buttonaddfaculty,buttonviewfaculty,buttonlogout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_adminmanager);
       buttonaddfaculty = (Button)findViewById(R.id.buttonaddfaculty);
       buttonviewfaculty=(Button)findViewById(R.id.buttonviewfaculty);
       buttonlogout=(Button)findViewById(R.id.buttonlogout);

       buttonlogout.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View v) {
               SharedPrefManager.getInstance(adminmanager.this).logout();
               finish();
               startActivity(new Intent(adminmanager.this,homepage.class));

           }
       });
buttonaddfaculty.setOnClickListener(new View.OnClickListener() {
    @Override
    public void onClick(View v) {
        Intent i=new Intent(adminmanager.this,addFaculty2.class);
        startActivity(i);

    }
});
buttonviewfaculty.setOnClickListener(new View.OnClickListener() {
    @Override
    public void onClick(View v) {
        Intent i2 = new Intent(adminmanager.this,viewFaculty.class);
        startActivity(i2);
    }
});

    }
    }