db['LoanStats3b-2'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$lookup: {
			    from : "LoanStats3b-1",
			    localField : "id",
			    foreignField : "id",
			    as : "TEST"
			}
		},

		// Stage 2
		{
			$match: {
			    "loan_status":"Current"
			}
		},

		// Stage 3
		{
			$unwind: "$TEST"
		},

		// Stage 4
		{
			$project: {
			    member_id:"$TEST.member_id",
			    "last_pymnt_d":1,
			    "last_pymnt_amnt":1,
			    "next_ptmnt_d":1
			}
		},
	],

	// Options
	{
		cursor: {
			batchSize: 50
		},

		allowDiskUse: true
	}

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
