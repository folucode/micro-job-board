# Micro-Job-Board

## Description

This is an API for a fictional job board(micro-job-board), where a business can sign up and post jobs and users can find jobs posted by a business and apply for them.

#### App URL
micro-job-board.herokuapp.com/

#### Exisiting Business Credentials
email: business@example.com, password: password

## Endpoints

**url:** {domain}/api/v1/{endpoint}

#### Auth Routes

1.  `POST: /logout` Logout User

1.  `GET: /user` Return User Profile

1. `POST: /my/jobs` Posts a Job

	Params: [
		'title',
        'company',
        'company_logo',
        'location',
        'salary',
        'description',
        'benefits',
        'type',
        'condition',
        'submission_deadline',
        'category'
]

1. `GET: /my/jobs/` Get jobs posted by User

1. `PATCH: /my/jobs/{job_id}` Update an already existing job

	Params(**i.e any of these**): [
		'title',
        'company',
        'company_logo',
        'location',
        'salary',
        'description',
        'benefits',
        'type',
        'condition',
        'submission_deadline',
        'category'
]

1. `DELETE: my/jobs/{job_id}` Delete a job posted by User

#### Guest Routes

1. `POST: /register`  Create a new user

	Params: [
        'name',
        'email',
        'avatar',
        'password',
		'password_confirmation'
    ];
1.  `POST: /login` Login User

	Params: [
        'email',
        'password',
]

1. `GET: /jobs` Get all jobs

1. `GET: /jobs/search?q={search_term}` Search for a job

1. `GET: /jobs/{job_id}` Get a particular job

1. `POST: /jobs/{job_id}/apply` Apply for a particular job

	Params: [
		'first_name',
		'last_name',
		'email',
		'phone',
		'location',
		'cv'
	]
