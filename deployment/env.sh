#!/bin/bash
aws ssm get-parameter --name "Upschool.Env" --region us-east-1 --query "Parameter.Value" --output text > .env
