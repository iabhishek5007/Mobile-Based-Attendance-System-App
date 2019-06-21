package com.frost.attendance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class FacultyManager extends AppCompatActivity {
Button buttontakeattendance;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faculty_manager);
        buttontakeattendance=(Button)findViewById(R.id.btnTakeAttendance);

        buttontakeattendance.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(FacultyManager.this, phpcodes.class);
                startActivity(intent);
            }
        });
    }
}
