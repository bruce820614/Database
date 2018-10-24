db['LoanStats3b-3'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$match: {
			$and:[
			{"verification_status":"Not Verified"},
			{"dti":{$gt:30}}
			]
			}
		},

		// Stage 2
		{
			$project: {
			"loan_status":1,"grade":1,"int_rate":1
			}
		},

	]

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
