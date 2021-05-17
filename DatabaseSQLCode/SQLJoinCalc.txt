SELECT accounting.course_code AS course_id,
courses.course_desciption as course_desciption,
SUM(accounting.hours_done) AS Hours_Spent
  FROM public.accounting accounting
  JOIN ( SELECT course_desciption,
		course_code
           FROM public.courses
          GROUP
            BY  course_code
       ) courses
    ON courses.course_code = accounting.course_code
 GROUP
    BY course_id, course_desciption
	ORDER
	BY course_desciption ASC