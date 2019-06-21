package com.frost.attendance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebView;
import android.widget.Button;

public class homepage extends AppCompatActivity {

    Button btnNotice,btnFaculty,btnAdmin,btnStudent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_homepage);
        btnNotice= (Button)findViewById(R.id.btnnotice);
        btnAdmin=(Button)findViewById(R.id.btnadmin);
        btnFaculty=(Button)findViewById(R.id.btnfaculty);
        btnStudent=(Button)findViewById(R.id.btnstudent);

        btnNotice.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(homepage.this,Notice.class);
                startActivity(intent);
            }
        });

        btnAdmin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i1= new Intent(homepage.this,AdminLoginScreen.class);
                startActivity(i1);

            }
        });

        btnFaculty.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i2= new Intent(homepage.this,FacultyLoginScreen.class);
                startActivity(i2);
            }
        });

        btnStudent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i3=new Intent(homepage.this,StudentLogin.class);
                startActivity(i3);
            }
        });

    }

}
